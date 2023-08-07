import { Head } from '@inertiajs/react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'

import 'react-toastify/dist/ReactToastify.css'
import { ToastContainer } from 'react-toastify'

import '../../css/dashboard.css'
import { Order } from './Payments/Order'
import { Pending } from './Payments/Pending'
import { Historic } from './Payments/Historic'
import { CreditCard } from './Payments/CreditCard'

export default function Dashboard({ auth, orders, payments, paid, infos, card }) {

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
                                <Order order={order} card={card} key={order.id}/>
                            ))}
                        </div>
                    </div>

                    <div>
                        <h1>Pagametos pendentes</h1>
                        <div className="dashboard-payment-await">
                            {payments.map((payment) => (
                                <Pending payment={payment} key={payment.id}/>
                            ))}
                        </div>
                    </div>
                </div>
                <div className="dashboard-historys">
                    {card != null ?
                    <CreditCard card={card}/>
                    : null }
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