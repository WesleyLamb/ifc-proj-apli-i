import { SELECTED_ESTABLISHMENT, API_URL } from "@/constants";
import http from "@/classes/http";

var establishment;

export default {
    establishment,

    getDefaultEstablishmentId() {
        return localStorage.getItem(SELECTED_ESTABLISHMENT);
    },
    setSelectedEstablishment(establishment) {
        localStorage.setItem(SELECTED_ESTABLISHMENT, establishment.id);
        return this.showEstablishment(establishment.id).then((response) => {
            this.establishment = response.data.data;
        });
    },
    getEstablishments() {
        return http.get(`${API_URL}/establishments`);
    },
    showEstablishment(establishmentId) {
        return http.get(`${API_URL}/establishments/${establishmentId}`);
    },
    registerEstablishment(data) {
        return http.post(`${API_URL}/establishments`, data).then((response) => {
            this.setSelectedEstablishment(response.data.data);
        })
    }
}