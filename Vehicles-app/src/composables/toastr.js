import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';


const useToastr = (msg='Done successfully', success=true) => {
    if (success) {
        toast.success(msg);
    }else{
        toast.error(msg);
    }
};
export {useToastr};