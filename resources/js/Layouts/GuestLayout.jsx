/*import Lottie from 'react-lottie';
import shape from '../Animations/BG.json'*/

import '../../css/style.css'

export default function Guest({ children }) {
    /*const defaultOptions = {
        loop: true,
        autoplay: true, 
        animationData: shape,
        rendererSettings: {
            preserveAspectRatio: 'xMidYMid slice'
        }
    };*/

    return (
        <>
            <div className="login-bg">
                {/*<Lottie options={defaultOptions} height={1000} width={1500} />*/}
            </div>

            <div className="min-h-screen flex flex-col sm:justify-center items-center dark:bg-dots-lighter bg-boxl">

                <div className="login-card">
                    {children}
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
