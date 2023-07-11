import 'react-toastify/dist/ReactToastify.css';
import { Head, useForm } from '@inertiajs/react';
import { ToastContainer, toast } from 'react-toastify';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faDollarSign } from '@fortawesome/free-solid-svg-icons'
import { faCcVisa, faCcMastercard } from '@fortawesome/free-brands-svg-icons'

import '../../css/dashboard.css'

export default function Dashboard({ auth, orders, payments, paid, infos }) {

    const { post, setData, errors } = useForm({
        orderID: ''
    })
    
    const generateCode = (e) => {
        e.preventDefault();

        post(route('generateCode'), {
            preserveScroll: true,
            onSuccess: () => {
                toast.success('QR code gerado com sucesso', {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                    theme: "light",
                });
            },
            onError: (errors) => {
                toast.error(errors.message, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                    theme: "light",
                });
            },
        });
    };

    function WaitingPayment(payment) {
        return (
            <div className="payment-await">
                <div>
                    <h1>{payment.payment.amount}</h1>
                    <span>{payment.payment.transaction_id}</span>
                </div>
                <div>
                    <div className="payment-image">
                        <img src={'data:image/png;base64,' + payment.payment.base64_image} />
                    </div>
                </div>
            </div>
        )
    }

    function Wallet(){
        return (
            <div className="dashboard-block dashboard-wallet">
                <div className="wallet-flag">
                    <FontAwesomeIcon icon={faCcVisa} size="3x" />
                </div>
                <div className="wallet-info">
                    <h1>**** **** **** 4741</h1>
                    <div className="wallet-info-date">
                        <div>
                            <span>Nome completo</span>
                            <h2>Rodrigo Gomes da Costa</h2>
                        </div>
                        <div>
                            <span>Validade</span>
                            <h2>06/25</h2>
                        </div>
                    </div>
                </div>
                <div className="wallet-bg">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 800"><defs><linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="rrreflection-grad"><stop stop-color="#432eef7a" stop-opacity="1" offset="45%"></stop><stop stop-color="#402aef1e" stop-opacity="1" offset="100%"></stop></linearGradient><linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="rrreflection-grad-2"><stop stop-color="#402aef1e" stop-opacity="1" offset="0%"></stop><stop stop-color="#432eef7a" stop-opacity="1" offset="45%"></stop></linearGradient><linearGradient gradientTransform="rotate(270)" x1="50%" y1="0%" x2="50%" y2="100%" id="rrreflection-grad-3"><stop stop-color="#432eef7a" stop-opacity="1" offset="45%"></stop><stop stop-color="#402aef1e" stop-opacity="1" offset="100%"></stop></linearGradient><linearGradient gradientTransform="rotate(270)" x1="50%" y1="0%" x2="50%" y2="100%" id="rrreflection-grad-4"><stop stop-color="#402aef1e" stop-opacity="1" offset="0%"></stop><stop stop-color="#432eef7a" stop-opacity="1" offset="45%"></stop></linearGradient></defs><g stroke-width="2" stroke="url(#rrreflection-grad)" fill="none"><circle r="375" cx="50%" cy="0"></circle><circle r="362.5" cx="50%" cy="0"></circle><circle r="350" cx="50%" cy="0"></circle><circle r="337.5" cx="50%" cy="0"></circle><circle r="325" cx="50%" cy="0"></circle><circle r="312.5" cx="50%" cy="0"></circle><circle r="300" cx="50%" cy="0"></circle><circle r="287.5" cx="50%" cy="0"></circle><circle r="275" cx="50%" cy="0"></circle><circle r="262.5" cx="50%" cy="0"></circle><circle r="250" cx="50%" cy="0"></circle><circle r="237.5" cx="50%" cy="0"></circle><circle r="225" cx="50%" cy="0"></circle><circle r="212.5" cx="50%" cy="0"></circle><circle r="200" cx="50%" cy="0"></circle><circle r="187.5" cx="50%" cy="0"></circle><circle r="175" cx="50%" cy="0"></circle><circle r="162.5" cx="50%" cy="0"></circle><circle r="150" cx="50%" cy="0"></circle><circle r="137.5" cx="50%" cy="0"></circle><circle r="125" cx="50%" cy="0"></circle><circle r="112.5" cx="50%" cy="0"></circle><circle r="100" cx="50%" cy="0"></circle><circle r="87.5" cx="50%" cy="0"></circle><circle r="75" cx="50%" cy="0"></circle><circle r="62.5" cx="50%" cy="0"></circle><circle r="50" cx="50%" cy="0"></circle><circle r="37.5" cx="50%" cy="0"></circle><circle r="25" cx="50%" cy="0"></circle><circle r="12.5" cx="50%" cy="0"></circle></g><g stroke-width="2" stroke="url(#rrreflection-grad-2)" fill="none"><circle r="375" cx="50%" cy="100%"></circle><circle r="362.5" cx="50%" cy="100%"></circle><circle r="350" cx="50%" cy="100%"></circle><circle r="337.5" cx="50%" cy="100%"></circle><circle r="325" cx="50%" cy="100%"></circle><circle r="312.5" cx="50%" cy="100%"></circle><circle r="300" cx="50%" cy="100%"></circle><circle r="287.5" cx="50%" cy="100%"></circle><circle r="275" cx="50%" cy="100%"></circle><circle r="262.5" cx="50%" cy="100%"></circle><circle r="250" cx="50%" cy="100%"></circle><circle r="237.5" cx="50%" cy="100%"></circle><circle r="225" cx="50%" cy="100%"></circle><circle r="212.5" cx="50%" cy="100%"></circle><circle r="200" cx="50%" cy="100%"></circle><circle r="187.5" cx="50%" cy="100%"></circle><circle r="175" cx="50%" cy="100%"></circle><circle r="162.5" cx="50%" cy="100%"></circle><circle r="150" cx="50%" cy="100%"></circle><circle r="137.5" cx="50%" cy="100%"></circle><circle r="125" cx="50%" cy="100%"></circle><circle r="112.5" cx="50%" cy="100%"></circle><circle r="100" cx="50%" cy="100%"></circle><circle r="87.5" cx="50%" cy="100%"></circle><circle r="75" cx="50%" cy="100%"></circle><circle r="62.5" cx="50%" cy="100%"></circle><circle r="50" cx="50%" cy="100%"></circle><circle r="37.5" cx="50%" cy="100%"></circle><circle r="25" cx="50%" cy="100%"></circle><circle r="12.5" cx="50%" cy="100%"></circle></g><g stroke-width="2" stroke="url(#rrreflection-grad-3)" fill="none"><circle r="375" cx="0" cy="50%"></circle><circle r="362.5" cx="0" cy="50%"></circle><circle r="350" cx="0" cy="50%"></circle><circle r="337.5" cx="0" cy="50%"></circle><circle r="325" cx="0" cy="50%"></circle><circle r="312.5" cx="0" cy="50%"></circle><circle r="300" cx="0" cy="50%"></circle><circle r="287.5" cx="0" cy="50%"></circle><circle r="275" cx="0" cy="50%"></circle><circle r="262.5" cx="0" cy="50%"></circle><circle r="250" cx="0" cy="50%"></circle><circle r="237.5" cx="0" cy="50%"></circle><circle r="225" cx="0" cy="50%"></circle><circle r="212.5" cx="0" cy="50%"></circle><circle r="200" cx="0" cy="50%"></circle><circle r="187.5" cx="0" cy="50%"></circle><circle r="175" cx="0" cy="50%"></circle><circle r="162.5" cx="0" cy="50%"></circle><circle r="150" cx="0" cy="50%"></circle><circle r="137.5" cx="0" cy="50%"></circle><circle r="125" cx="0" cy="50%"></circle><circle r="112.5" cx="0" cy="50%"></circle><circle r="100" cx="0" cy="50%"></circle><circle r="87.5" cx="0" cy="50%"></circle><circle r="75" cx="0" cy="50%"></circle><circle r="62.5" cx="0" cy="50%"></circle><circle r="50" cx="0" cy="50%"></circle><circle r="37.5" cx="0" cy="50%"></circle><circle r="25" cx="0" cy="50%"></circle><circle r="12.5" cx="0" cy="50%"></circle></g><g stroke-width="2" stroke="url(#rrreflection-grad-4)" fill="none"><circle r="375" cx="100%" cy="50%"></circle><circle r="362.5" cx="100%" cy="50%"></circle><circle r="350" cx="100%" cy="50%"></circle><circle r="337.5" cx="100%" cy="50%"></circle><circle r="325" cx="100%" cy="50%"></circle><circle r="312.5" cx="100%" cy="50%"></circle><circle r="300" cx="100%" cy="50%"></circle><circle r="287.5" cx="100%" cy="50%"></circle><circle r="275" cx="100%" cy="50%"></circle><circle r="262.5" cx="100%" cy="50%"></circle><circle r="250" cx="100%" cy="50%"></circle><circle r="237.5" cx="100%" cy="50%"></circle><circle r="225" cx="100%" cy="50%"></circle><circle r="212.5" cx="100%" cy="50%"></circle><circle r="200" cx="100%" cy="50%"></circle><circle r="187.5" cx="100%" cy="50%"></circle><circle r="175" cx="100%" cy="50%"></circle><circle r="162.5" cx="100%" cy="50%"></circle><circle r="150" cx="100%" cy="50%"></circle><circle r="137.5" cx="100%" cy="50%"></circle><circle r="125" cx="100%" cy="50%"></circle><circle r="112.5" cx="100%" cy="50%"></circle><circle r="100" cx="100%" cy="50%"></circle><circle r="87.5" cx="100%" cy="50%"></circle><circle r="75" cx="100%" cy="50%"></circle><circle r="62.5" cx="100%" cy="50%"></circle><circle r="50" cx="100%" cy="50%"></circle><circle r="37.5" cx="100%" cy="50%"></circle><circle r="25" cx="100%" cy="50%"></circle><circle r="12.5" cx="100%" cy="50%"></circle></g></svg>
                </div>
            </div>
        )
    }

    function Historic(paid) {
        return (
            <div className="history">
                <div className="history-icon">
                    <FontAwesomeIcon icon={faDollarSign} size="2x" />
                </div>
                <div className="history-data">
                    <div className="payment-history-data">
                        <h2>{paid.paid.transaction_id}</h2>
                        <span>{paid.paid.updated_at}</span>
                    </div>
                    <div className="payment-history-amount">
                        <h2>{paid.paid.amount.toFixed(2)}</h2>
                        <span>BRL</span>
                    </div>
                </div>
            </div>
        )
    }

    const totalSales = Object.values(infos).reduce((total, currentElement) => total + currentElement.order_total_paid, 0)
    const totalCost = Object.values(infos).reduce((total, currentElement) => total + currentElement.order_cost, 0)

    return (
        <AuthenticatedLayout user={auth.user}>

            <Head title="Dashboard" />

            <ToastContainer />

            <div className="dashboard-title">
                <h1>Dashboard</h1>
            </div>

            <div className="dashboard-cash-blocks">
                <div className="cash-block">
                    <div className="cash-value">
                        <h1>
                            {totalSales.toFixed(2)}
                        </h1>
                        <span>BRL</span>
                    </div>
                    <div className="cash-title">
                        <span>Vendas</span>
                    </div>
                </div>
                <div className="cash-block">
                    <div className="cash-value">
                        <h1>
                            {totalCost.toFixed(2)}
                        </h1>
                        <span>BRL</span>
                    </div>
                    <div className="cash-title">
                        <span>Custo</span>
                    </div>
                </div>
                <div className="cash-block">
                    <div className="cash-value">
                        <h1>
                            {(totalSales - totalCost).toFixed(2)}
                        </h1> 
                        <span>BRL</span>
                    </div>
                    <div className="cash-title">
                        <span>Lucro</span>
                    </div>
                </div>
            </div>
            <div className="dashboard-main-blocks">
                <div className="dashboard-block dashboard-payments">
                    <div>
                        <h1>Pedidos pendentes</h1>
                        <div className="dashboard-payment">
                            {orders.map((order) => (
                                <div className="payment-block" key={order.id}>
                                    <div>
                                        <h1>{order.order_cost.toFixed(2)}</h1>
                                        <span>Frete = {order.order_fee} BRL</span>
                                        <span>{order.code}</span>
                                    </div>
                                    <div>
                                        <form method="post" onSubmit={generateCode}>
                                            <button className="payment-button" type="submit" onClick={() => setData({orderID: order.id })}>Fazer Pagamento</button>
                                        </form>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    <div>
                        <h1>Pagametos pendentes</h1>
                        <div className="dashboard-payment-await">
                            {payments.map((payment) => (
                                <WaitingPayment payment={payment} key={payment.id}/>
                            ))}
                        </div>
                    </div>
                </div>
                <div className="dashboard-historys">
                    {/*<Wallet />*/}
                    <div className="dashboard-history fg-overflow-scroll">
                        <div className="history-content fg-padding">
                            <h1>Histórico de pagamentos</h1>
                            {paid.map((paymentsPaid) => (
                                <Historic paid={paymentsPaid} key={paymentsPaid.id}/>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
            
        </AuthenticatedLayout>
    );
}

