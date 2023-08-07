import './index.css'

import { Head } from '@inertiajs/react'
import { Cards } from './Components/Cards'

import 'react-toastify/dist/ReactToastify.css'
import { ToastContainer } from 'react-toastify'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'

import { initMercadoPago, CardPayment } from '@mercadopago/sdk-react'
import { Success } from '../Messages/Success'
import { Error } from '../Messages/Error'

initMercadoPago('TEST-ab9b0a98-f794-4c2a-97bf-d50f0fba0f68', { locale: 'pt-BR' })

export default function Wallet({ auth, cards }) {
    const initialization = {
        amount: 1,
    }

    const customization = {
        visual: {
            style: {
                customVariables: {
                    textPrimaryColor: "#FFFFFF",
                    textSecondaryColor: "#413c6b",
                    inputBackgroundColor: "transparent",
                    formBackgroundColor: "#252147",
                    baseColor: "#6757E9",
                    outlinePrimaryColor: "#FFA200",
                },
            },
            texts: {
                formTitle: "Cadastrar cartão",
                formSubmit: "Cadastrar"
            }
        },
        paymentMethods: {
            minInstallments: 0,
            maxInstallments: 0,
        },
    }

    const onSubmit = async (param) => {
        return new Promise((resolve, reject) => {
            fetch("/process_payment", {
                method: "POST",
                headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(param),
            })
            .then(() => {
                Success("Cartão cadastrado com sucesso")

                setTimeout(function(){
                    location.reload()
                }, 5000)
                
                resolve()
            })
            .catch((error) => {
                //
                reject()
            })
        })
    }

    

    return (
        <AuthenticatedLayout user={auth.user}>

            <Head title="Carteira" />

            <ToastContainer />
            
            <div className="creditCard-container">
                <div className='form'>
                    <CardPayment initialization={initialization} customization={customization} onSubmit={onSubmit} />  
                </div>
                
                <div className="card-container">
                    <h1>Seus cartões</h1>
                    {cards.map((card) => (
                        <Cards card={card} key={card.id} unique={cards.length == 1 ? true : false} />
                    ))}
                </div>  
            </div>
            
        </AuthenticatedLayout>
    )
}

