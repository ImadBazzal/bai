export const ACTIONS = {
    LOGIN: "login",
    LOGOUT: "logout",
};

const state = {
    token: localStorage.getItem('auth_token'),
    username: localStorage.getItem('username'),
}

const getters = {
    isAuthenticated: state => !!state.token && !!state.username,
    getUsername: state => state.username,
}

const actions = {
    [ACTIONS.LOGIN]: async ({commit}, data) => {
        const token = btoa(data.username + ":" + data.password)

        commit(ACTIONS.LOGIN, {token, username: data.username});
    },
    [ACTIONS.LOGOUT]: async ({commit}) => {
        commit(ACTIONS.LOGOUT);
    },
}

const mutations = {
    [ACTIONS.LOGIN]: (state, {token, username}) => {
        localStorage.setItem('auth_token', token)
        localStorage.setItem('username', username)

        location.reload();
    },
    [ACTIONS.LOGOUT]: () => {
        localStorage.removeItem('auth_token')
        localStorage.removeItem('username')

        location.reload();
    },
}

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters
}
