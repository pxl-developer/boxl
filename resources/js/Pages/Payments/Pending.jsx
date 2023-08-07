export function Pending(props){
    return (
        <div className="payment-await">
            <div>
                <h1>{props.payment.amount}</h1>
                <span>{props.payment.transaction_id}</span>
            </div>
            <div>
                <div className="payment-image">
                    <img src={'data:image/png;base64,' + props.payment.base64_image} />
                </div>
            </div>
        </div>
    )
}