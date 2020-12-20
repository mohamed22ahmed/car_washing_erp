export default {
    state: {
        userPermission: []
    },
    getters: {
        getUserPermission(state) {
            //alert(1);
            return state.userPermission
        },
    },

    actions: {
        loaddictionary() {
            axios.get('api/userpermission').then(response => {
                this.state.userPermission = response.data;
            });
        },
        loaduserPermission() {
            axios.get('api/userpermission').then(response => {
                this.state.userPermission = response.data;
            });
        }
    }
}