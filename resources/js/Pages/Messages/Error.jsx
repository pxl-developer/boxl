import { toast } from 'react-toastify'

export const Error = (error) => {
    return(
        toast.error(
            error, {
                position: "top-right",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
                theme: "light",
            }
        )
    )
}