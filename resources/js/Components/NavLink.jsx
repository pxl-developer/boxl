import { Link } from '@inertiajs/react';

export default function NavLink({ active = false, className = '', children, ...props }) {
    return (
        <Link
            {...props}
            className={
                'nav-button ' +
                (active
                    ? 'border-active icon-white '
                    : 'border-none text-gray ') +
                className
            }
        >
            {children}
        </Link>
    );
}
