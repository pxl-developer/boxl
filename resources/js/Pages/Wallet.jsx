import { Head } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Wallet({ auth }) {

    return (
        <AuthenticatedLayout user={auth.user}>

            <Head title="Carteira" />

            <h1>Página em construção</h1>
            
        </AuthenticatedLayout>
    );
}

