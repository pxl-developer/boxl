import { faDollarSign } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'

export function Historic(props){
    return (
        <div className="history">
            <div className="history-icon">
                <FontAwesomeIcon icon={faDollarSign} size="2x" />
            </div>
            <div className="history-data">
                <div className="payment-history-data">
                    <h2>{props.paid.transaction_id}</h2>
                    <span>{props.paid.updated_at}</span>
                </div>
                <div className="payment-history-amount">
                    <h2>{props.paid.amount.toFixed(2)}</h2>
                    <span>BRL</span>
                </div>
            </div>
        </div>
    )
}