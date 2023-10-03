import React from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, useForm } from '@inertiajs/react';
import { ToastContainer } from 'react-toastify';

export default function sku({ status }) {
    const { data, setData, post, processing, errors } = useForm({
        sku: '',
        cost: '',
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('skuadmin.store'))
    };

    {console.log(status)}
    return (
        <GuestLayout>
            <Head title="Log in" />

            <ToastContainer />

            {status && (
                <div className="alert alert-success">
                    {status}
                </div>
            )}

            <form onSubmit={submit}>
                <div>
                    <InputLabel htmlFor="sku" value="SKU" />

                    <TextInput
                        id="sku"
                        type="sku"
                        name="sku"
                        className="mt-1 block w-full"
                        isFocused={true}
                        onChange={(e) => setData('sku', e.target.value)}
                    />

                    <InputError message={errors.sku} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="cost" value="Custo" />

                    <TextInput
                        id="cost"
                        type="cost"
                        name="cost"
                        className="mt-1 block w-full"
                        onChange={(e) => setData('cost', e.target.value)}
                    />

                    <InputError message={errors.cost} className="mt-2" />
                </div>
                <div className="flex items-center justify-end mt-4">
                    <PrimaryButton className="ml-4" disabled={processing}>
                        Cadastrar
                    </PrimaryButton>
                </div>
            </form>
            
        </GuestLayout>
    );
}
