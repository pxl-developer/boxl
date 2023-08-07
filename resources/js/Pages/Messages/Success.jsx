import { toast } from 'react-toastify'

export const Success = (success) => {
    return(
        toast.success(
            success, {
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