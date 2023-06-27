import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import DeleteUserForm from './Partials/DeleteUserForm';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';
import { Head } from '@inertiajs/react';

export default function Edit({ auth, mustVerifyEmail, status }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>}
        >
            <Head title="Profile" />

            <div className="fg-flex edit-blocks edit-profile">
                <div className="edit-content edit-block-1">
                    <UpdateProfileInformationForm
                        mustVerifyEmail={mustVerifyEmail}
                        status={status}
                        className="max-w-xl"
                    />
                </div>

                <div className="edit-content edit-block-2 fg-padding">
                    <UpdatePasswordForm className="max-w-xl" />
                </div>

                {/*<div className="">
                    <DeleteUserForm className="max-w-xl" />
                </div>*/}
            </div>
        </AuthenticatedLayout>
    );
}
