import { useForm } from '@inertiajs/react'
import { faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'

import 'react-toastify/dist/ReactToastify.css'
import { Success } from '@/Pages/Messages/Success'
import { Error } from '@/Pages/Messages/Error'

export function DeleteButton(props){
    const { data, setData, delete: destroy, processing } = useForm({
        id: '',
    });
    
    const deleteCard = (e) => {
        e.preventDefault()
    
        destroy(route('wallet.destroy', data), { 
            preserveScroll: true,
            onSuccess: () => {
                Success("Cartão excluido com sucesso")
            },
            onError: () => {
                Error("Houve um erro ao excluir o cartão")
            },
        })
    }
    
    return(
        <div className="remove">
            <form method="post" onSubmit={deleteCard}>
                <button onClick={(e) => setData('id', props.card)} disabled={processing} type="submit"><FontAwesomeIcon icon={faTrash} size="xl" /></button>
            </form>
        </div>
    )
}