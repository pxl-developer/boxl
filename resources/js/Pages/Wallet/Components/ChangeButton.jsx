import { useForm } from '@inertiajs/react'
import { faStar } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'

export function ChangeButton(props){
    const { data, setData, patch, processing } = useForm({
        id: '',
    });

    const preferencialCard = (e) => {
        e.preventDefault()
    
        patch(route('wallet.update', data), { 
            preserveScroll: true,
            onFinish: () => reset(),
        })
    }

    return(
        <div className={props.card.preferencial ? 'disabled-card' : 'preferencial-button edit-card'  }>
            <form method="post" onSubmit={preferencialCard}>
                <button onClick={(e) => setData('id', props.card.id)} disabled={props.card.preferencial || processing} type="submit"><FontAwesomeIcon icon={faStar} size="xl" /></button>
            </form>
        </div>
    )
}