import auth from './modules/auth';
import notifications from './modules/notifications';
import agentService from '../services/agent';
import celebrityService from '../services/celebrity';
import emailService from '../services/email';
import logService from '../services/log';
import managerService from '../services/manager';
import publicistService from '../services/publicist';
import representativeService from '../services/representative';
import territoryService from '../services/territory';
import makeCrudModule from './modules/crud';
import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth,
        notifications,
        agent: makeCrudModule({
            service: agentService
        }),
        celebrity: makeCrudModule({
            service: celebrityService
        }),
        email: makeCrudModule({
            service: emailService
        }),
        log: makeCrudModule({
            service: logService
        }),
        manager: makeCrudModule({
            service: managerService
        }),
        publicist: makeCrudModule({
            service: publicistService
        }),
        representative: makeCrudModule({
            service: representativeService
        }),
        territory: makeCrudModule({
            service: territoryService
        }),

    }
});

export default store;