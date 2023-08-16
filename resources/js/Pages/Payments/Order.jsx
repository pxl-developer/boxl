import { useForm } from '@inertiajs/react'
import { useEffect, useRef, useState } from 'react'
import PrimaryButton from '@/Components/PrimaryButton'
import { initMercadoPago, createCardToken, SecurityCode } from '@mercadopago/sdk-react'

import { Success } from '../Messages/Success'
import { Error } from '../Messages/Error'

initMercadoPago('TEST-ab9b0a98-f794-4c2a-97bf-d50f0fba0f68', { locale: 'pt-BR' })

export function Order(props){
    const { data, setData, post, errors, processing } = useForm({
        orderID: '',
        cardToken: '',
        method: ''
    })

    const [pay, setPay] = useState(false);
    
    const sendRef = useRef(false)

    useEffect(() => {
        if (sendRef.current) {
            send()
            sendRef.current = false
        }
    })
    
    function send(){
        post(route('pay'), {
            preserveScroll: true,
            onSuccess: (message) => Success(message),
            onError: (errors) => { Error(errors) },
        })
    }
    
    const ccPay = (e) => {
        e.preventDefault()
    
        const token = createCardToken({
            cardId: props.card.card_id
        })
        
        token.then(result => {
            setData(prevData => ({
                ...prevData,
                cardToken: result.id,
                method: 'cc'
            }))
            sendRef.current = true
        })
    }
    
    const pixPay = (e) => {
        e.preventDefault()
        
        setData('method', 'pix')
    
        sendRef.current = true
    }

    return(
        <div className="payment-block">
            <div>
                <h1>{props.order.order_cost.toFixed(2)}</h1>
                <span>Frete = {props.order.order_fee} BRL</span>
                <span>{props.order.code}</span>
            </div>
            <div>
                <form method="post" onSubmit={pixPay}>
                    <PrimaryButton className="payment-button" disabled={processing} onClick={() => setData('orderID', props.order.id)}>
                        Pagar com Pix
                    </PrimaryButton>
                </form>
                {props.card != null ?
                    pay ? 
                        <form method="post" onSubmit={ccPay}>
                            <PrimaryButton className="payment-button" disabled={processing} onClick={() => setData('orderID', props.order.id)}>
                                Digite o CVV
                                <SecurityCode placeholder="CVV"/>
                            </PrimaryButton>
                        </form>
                    :
                        <button className="payment-button" disabled={processing} onClick={() => setPay(true)}>Pagar com cartão</button>
                : null }
            </div>
        </div>
    )
}