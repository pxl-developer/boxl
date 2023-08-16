import { Head } from '@inertiajs/react'
import { useForm } from '@inertiajs/react'
import TextInput from '@/Components/TextInput';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'

export default function Products({ auth }) {
    
    const { data, setData, get, errors, processing } = useForm()

    const handle = (e) => {
        e.preventDefault()
    
        get(route('products.show', data), {
            preserveScroll: true,

            onSuccess: (message) => Success(message),
            onError: (errors) => { Error(errors) },
        })
    }
    
    return (
        <AuthenticatedLayout user={auth.user}>

            <Head title="Dashboard" />

            <InputLabel htmlFor="name" value="SKU do produto" />

            <div className='search-block'>
                <form method="post" onSubmit={handle}>
                    <TextInput
                        id="search"
                        name="search"
                        className="w-full search-input"
                        isFocused={true}
                        required
                        onChange={(e) => setData('product', e.target.value)}
                    />
                    <PrimaryButton className="search-button" disabled={processing}>
                        <FontAwesomeIcon icon={faMagnifyingGlass} size="2x" />
                    </PrimaryButton>
                </form>
            </div>

        </AuthenticatedLayout>
    );
}
