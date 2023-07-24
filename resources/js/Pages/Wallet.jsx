import { Head } from '@inertiajs/react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import { initMercadoPago, CardPayment } from '@mercadopago/sdk-react'

import '../../css/wallet.css'

initMercadoPago('TEST-ab9b0a98-f794-4c2a-97bf-d50f0fba0f68', { locale: 'pt-BR' })

export default function Wallet({ auth }) {

    const initialization = {
        amount: 1,
    };
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
    };
    const onSubmit = async (param) => {
        // callback chamado ao clicar no botão de submissão dos dados
        console.log(param)
        return new Promise((resolve, reject) => {
            fetch("/process_payment", {
                method: "POST",
                headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(param),
            })
            .then((response) => response.json())
            .then((response) => {
                // receber o resultado do pagamento
                console.log(response)
                resolve();
            })
            .catch((error) => {
                // lidar com a resposta de erro ao tentar criar o pagamento
                console.log(error)
                reject();
            });
        });
    };
    const onError = async (error) => {
        // callback chamado para todos os casos de erro do Brick
    };
    const onReady = async () => {
        /*
          Callback chamado quando o Brick estiver pronto.
          Aqui você pode ocultar loadings do seu site, por exemplo.
        */
    };

    return (
        <AuthenticatedLayout user={auth.user}>

            <Head title="Carteira" />
            
            <div className='creditCard-container'>
                <CardPayment
                    initialization={initialization}
                    customization={customization}
                    onSubmit={onSubmit}
                    onReady={onReady}
                    onError={onError}
                />
            </div>
            
        </AuthenticatedLayout>
    );
}

