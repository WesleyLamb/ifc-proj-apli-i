import { SELECTED_ESTABLISHMENT, API_URL } from "@/constants";
import http from "@/classes/http";

var establishment;

export default {
    establishment,
    getSelectedEstablishment() {
        const establishmentId = localStorage.getItem(SELECTED_ESTABLISHMENT);
        if (establishmentId) {
            return http.get(`${API_URL}/establishments/${establishmentId}`).then((response) => {
                establishment = response.data.data;
            });
        } else {
            return false;
        }
    },
    setSelectedEstablishment(establishment) {
        localStorage.setItem(SELECTED_ESTABLISHMENT, establishment.id);
        return this.getSelectedEstablishment();
    },
    getEstablishments() {
        return http.get(`${API_URL}/establishments`);
    },
    registerEstablishment(data) {
        return http.post(`${API_URL}/establishments`, data).then((response) => {
            this.setSelectedEstablishment(response.data.data);
        })
    }
}