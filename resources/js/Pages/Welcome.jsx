import { Link, Head } from '@inertiajs/react';

import '../../css/style.css'
import banner_1 from '../Images/banner-welcome-1.webp'
import banner_2 from '../Images/banner-welcome-2.webp'

export default function Welcome({ auth }) {
    const defaultOptions = {
        loop: true,
        autoplay: true, 
        animationData: logo,
        rendererSettings: {
            preserveAspectRatio: 'xMidYMid slice'
        }
    };

    return (
        <>
            <Head title="Bem vindo" />
            <div className="min-h-screen bg-center dark:bg-dots-lighter bg-boxl">
                <div className="fg-min-screen-height fg-flex">
                    <div className="fg-flex fg-dir-col fg-flex-1">
                        <div className="fg-margin-auto">
                            <Lottie options={defaultOptions} height={450} width={350} />
                        </div>
                        <div className="fg-welcome">
                            <h1>Bem vindo a BOXL</h1>
                        </div>
                    </div>
                    <div className="fg-flex-1">
                        <div className="fg-blocks fg-dir-col">
                            <div>
                                <div className="block-content block-1">
                                    {auth.user ? (
                                        <Link href={route('dashboard')}>
                                            DASHBOARD
                                        </Link>
                                    ) : (
                                        <Link href={route('login')}>
                                            ACESSAR
                                        </Link>
                                    )}
                                </div>
                                <div className="block-content block-2">
                                    A sua plataforma de dropshipping rápida e descomplicada
                                </div>
                            </div>
                            <div>
                                <div className="block-content block-3">
                                    <img src={banner_1} />
                                </div>
                                <div className="block-content block-3">
                                    <img src={banner_2} />
                                </div>
                            </div>
                            <div>
                                <div className="block-content block-4">
                                    <a href="https://assinaturaboxl.pxlsolutions.com.br/">Como vender</a>
                                </div>
                                <div className="block-content block-4">
                                    <a href="https://boxl.com.br/">Contato</a>
                                </div>
                                <div className="block-content block-4">
                                    <a href="https://boxl.com.br/">Sobre nós</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>{`
                .bg-dots-darker {
                    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.7)'/%3E%3C/svg%3E");
                }
                @media (prefers-color-scheme: dark) {
                    .dark\\:bg-dots-lighter {
                        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
                    }
                }
            `}</style>
        </>
    );
}
