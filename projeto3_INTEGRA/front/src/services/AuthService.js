import http from '@/classes/http'
import { REFRESH_TOKEN, ACCESS_TOKEN, TOKEN_EXPIRATION, API_URL } from '@/constants';

function updateTokens(access_token, refresh_token, expires_in) {
  let d = new Date();
  d.setSeconds(d.getSeconds() + expires_in);
  localStorage.setItem(ACCESS_TOKEN, access_token);
  localStorage.setItem(REFRESH_TOKEN, refresh_token);
  localStorage.setItem(TOKEN_EXPIRATION, d);
}

export default {
  getAuthenticatedUser() {
    return http.get(`${API_URL}/users/me`)
  },

  isAuthenticated() {
    const access_token = localStorage.getItem(ACCESS_TOKEN);
    const token_expiration = localStorage.getItem(TOKEN_EXPIRATION);
    if (access_token && token_expiration) {
      const d = new Date(token_expiration);
      return access_token && d.getTime() > (new Date()).getTime();
    }
    return false;
  },

  logout() {
    return http.get(`${API_URL}/auth/logout`).then((response) => {
      localStorage.removeItem(ACCESS_TOKEN);
      localStorage.removeItem(REFRESH_TOKEN);
      localStorage.removeItem(TOKEN_EXPIRATION);
    });
  },

  refresh() {
    return http.post(`${API_URL}/auth/refresh`, {
      refresh_token: localStorage.getItem(REFRESH_TOKEN),
    }).then((response) => {
      const { access_token, refresh_token, expires_in } = response.data
      updateUser();
      updateTokens(access_token, refresh_token, expires_in);
    })
  },

  login(username, password) {
      return http.post(`${API_URL}/auth/login`, {
        username: username,
        password: password,
      }).then((response) => {
        const { access_token, refresh_token, expires_in } = response.data;
        updateTokens(access_token, refresh_token, expires_in);
      });
  },

  register(data) {
      return http.post(`${API_URL}/auth/register`, data).then((response) => {
        updateTokens(response.data.access_token, response.data.refresh_token, response.data.expires_in);
      });
  },

  async listarUsuarios() {
    try {
      const response = await http.get(API_URL);
      return response.data;
    } catch (error) {
      console.error('Erro ao listar usuários:', error);
      return [];
    }
  },

  async getUsuarioLogado() {
    try {
      const response = await http.get(`${API_URL}/users/me`);
      // console.log("Usuário logado obtido com sucesso:", response.data);
      return response.data;
    } catch (error) {
      console.error("Erro ao buscar usuário logado:", error);
      throw error;
    }
  },

  async obterUsuarioPorId(id) {
    try {
      const response = await http.get(`${API_URL}/${id}`);
      return response.data;
    } catch (error) {
      console.error(`Erro ao obter usuário (ID: ${id}):`, error);
      throw error;
    }
  },

  async atualizarUsuario(id, usuario) {
    try {
      const response = await http.put(`${API_URL}/${id}`, usuario);
      return response.data;
    } catch (error) {
      console.error(`Erro ao atualizar usuário (ID: ${id}):`, error);
      throw error;
    }
  },

  async deletarUsuario(id) {
    try {
      const response = await http.delete(`${API_URL}/${id}`);
      return response.data;
    } catch (error) {
      console.error(`Erro ao deletar usuário (ID: ${id}):`, error);
      throw error;
    }
  },

  async isAdmin() {
    try {
      const usuario = await this.getUsuarioLogado();

      return usuario?.data?.permissions?.includes('admin');
    } catch (error) {
      console.error('Erro ao verificar permissões do usuário:', error);
      return false;
    }
  }

};