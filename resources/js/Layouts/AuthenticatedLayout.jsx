import logo from '../Images/logo_boxl.png'
//import logo from '../Animations/site-logo-animated.json'

import NavLink from '@/Components/NavLink';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faBarsStaggered } from '@fortawesome/free-solid-svg-icons'
import { faWallet } from '@fortawesome/free-solid-svg-icons'

import '../../css/layout.css'
import '../../css/navigation.css'

export default function Authenticated({ user, children }) {
    /*const defaultOptions = {
        loop: true,
        autoplay: true, 
        animationData: logo,
        rendererSettings: {
            preserveAspectRatio: 'xMidYMid slice'
        }
    };*/

    return (
        <div className="authenticated">
            <div className="block-navigation">
                <div className="navigation-logo">
                    {/**
                     * 
                     * Lottie, incompatível com sdk do mercado pago
                     * 
                     <Lottie options={defaultOptions} height={50} width={50} />
                     */}
                     <img src={logo} width={50} />
                </div>

                <div className="navigation-icons">
                    <NavLink href={route('dashboard')} active={route().current('dashboard')} as="button">
                        <FontAwesomeIcon icon={faBarsStaggered} size="xl" />
                    </NavLink>
                    <NavLink href={route('wallet.index')} active={route().current('wallet.index')} as="button">
                        <FontAwesomeIcon icon={faWallet} size="xl" />
                    </NavLink>
                </div>
                <div>
                    <NavLink href={route('logout')} className="exit" method="post" as="button">
                        Sair
                    </NavLink>
                </div>
            </div>
            <div className="body-content">
                <main>{children}</main>
            </div>
        </div>
    );
}
