import http from '@/classes/http';
import { API_URL } from '@/constants';

export default {
    getApplications(establishmentId) {
        let params = {};
        if (establishmentId) {
            params.establishment_id = establishmentId;
        }

        return http.get(`${API_URL}/applications`, {params: params ?? null})
    }
}