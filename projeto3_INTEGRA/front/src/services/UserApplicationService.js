import http from '@/classes/http';
import { API_URL } from '@/constants';

export default {
    getApplications() {
        return http.get(`${API_URL}/applications`)
    }
}