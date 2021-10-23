<!-- App.vue -->
<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" app>
            <v-list dense>
                <v-list-item>
                    <v-list-item-action>
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Home</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item>
                    <v-list-item-action>
                        <v-icon>mdi-star-outline</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            <router-link :to="{ name: 'CelebrityList' }">Celebrities</router-link>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item>
                    <v-list-item-action>
                        <v-icon>mdi-account-star-outline</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            <router-link :to="{ name: 'RepresentativeList' }">Representatives</router-link>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item>
                    <v-list-item-action>
                        <v-icon>mdi-map</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            <router-link :to="{ name: 'TerritoryList' }">Territories</router-link>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar dense app color="indigo" dark>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>BAI test task</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn small @click="doLogout" outlined>Logout ({{username}})</v-btn>
        </v-app-bar>

        <v-main>
            <router-view></router-view>

            <v-dialog
                v-model="loginDialog"
                persistent
                max-width="290"
            >
                <v-card>
                    <v-card-title class="text-h5">
                        Login
                    </v-card-title>
                    <v-card-text>
                        <v-text-field v-model="loginData.username" label="Username" hide-details="auto"/>
                        <v-text-field v-model="loginData.password" label="Password" type="password" hide-details="auto"/>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="green darken-1"
                            text
                            @click="doLogin">
                            Login
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-main>
    </v-app>
</template>

<script>

import {mapActions, mapGetters} from "vuex";
import {ACTIONS} from "./store/modules/auth";

export default {
    data: () => ({
        drawer: null,
        loginDialog: false,
        loginData: {
            username: null,
            password: null
        }
    }),
    computed: {
      ...mapGetters({
          isAuthenticated: "auth/isAuthenticated",
          username: "auth/getUsername"
      })
    },
    methods: {
        ...mapActions('auth', {
            login: ACTIONS.LOGIN,
            logout: ACTIONS.LOGOUT,
        }),
        doLogin() {
            this.login(this.loginData)
        },
        doLogout() {
            this.logout()
        }
    },
    mounted() {
        if (!this.isAuthenticated) {
            this.loginDialog = true;
        }
    }
};
</script>