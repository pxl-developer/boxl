import '../../css/product.css'
import Modal from 'react-modal';
import { Head } from '@inertiajs/react'
import { useForm } from '@inertiajs/react'
import TextInput from '@/Components/TextInput'
import InputLabel from '@/Components/InputLabel'
import PrimaryButton from '@/Components/PrimaryButton'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faArrowRight, faArrowLeft } from '@fortawesome/free-solid-svg-icons'
import { useState } from 'react';

export default function Products({ auth, products }) {
    const initialState = {
        id: '',
        type: '',
        fee: '',
    }

    const { data, setData, post, processing } = useForm(initialState);

    const integrate = (e) => {
        e.preventDefault()
    
        post(route('products.store', data), { 
            preserveScroll: true,
        })
    }

    const customStyles = {
        content: {
          top: '50%',
          left: '50%',
          right: 'auto',
          bottom: 'auto',
          border: 'none',
          marginRight: '-50%',
          borderRadius: '15px',
          padding: '40px 30px 70px',
          backgroundColor: '#252147',
          transform: 'translate(-50%, -50%)',
        },
    }

    const [modalIsOpen, setIsOpen] = useState(false);

    function openModal(productID) {
      setIsOpen(true);

      setData('id', productID)
    }

    function closeModal() {
      setIsOpen(false);
    }

    function onChangeValueType(e){
        setData({...data, type: e.target.value})
    }

    function onChangeValueFee(e){
        setData({...data, fee: e.target.value})
    }
console.log(data)
    return (
        <AuthenticatedLayout user={auth.user}>

            <Head title="Dashboard" />
            
            <div className='product-block'>
            {
                products.data.map((product) => 
                    <div className='product-box' key={product.id}>
                        <div className='product-image'>
                            <img src={product.image_link} />
                        </div>
                        <span className='product-title'>{product.title}</span>
                        <div className='product-price'>
                            <span>Preço: {product.value}</span>
                            <span>Custo: {product.cost}</span>
                        </div>
                        <div className='product-button'>
                            <button className='product-button-ml' onClick={() => {openModal(product.product_id)}} disabled={processing}>Mercado Livre</button>
                        </div>
                    </div>
                )
            }
            </div>

            <div className='page-arrows'>
                <a href={products.links.at().url}><FontAwesomeIcon icon={faArrowLeft} size='2x' /></a>
                <a href={products.links.at(-1).url}><FontAwesomeIcon icon={faArrowRight} size='2x' /></a>
            </div>

            

            <Modal isOpen={modalIsOpen} onRequestClose={closeModal} style={customStyles}>
                <div className='modal-form'>
                    <h2>Mercado Livre</h2>
                    <form onSubmit={integrate}>
                        <fieldset>
                            <legend>Tipo de anúncio</legend>
                            <div className='modal-form-content' onChange={onChangeValueType}>
                                <div>
                                    <input type="radio" id="classic" name="type" value="classic" required />
                                    <label htmlFor="classic">Clássico</label>
                                </div>
                                <div>
                                    <input type="radio" id="premium" name="type" value="premium" />
                                    <label htmlFor="premium">Premium</label>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Entrega</legend>
                            <div className='modal-form-content' onChange={onChangeValueFee}>
                                <div>
                                    <input type="radio" id="free" name="fee" value="free" required />
                                    <label htmlFor="free">Frete grátis para todo o Brasil</label>
                                </div>
                                <div>
                                    <input type="radio" id="paid" name="fee" value="paid" />
                                    <label htmlFor="paid">Pago pelo comprador</label>
                                </div>
                            </div>
                        </fieldset>
                        <button className='product-button-ml' onClick={(e) => setData({...data,})} disabled={processing}>Cadastrar produto</button>
                    </form>
                </div>
            </Modal>

        </AuthenticatedLayout>
    );
}
