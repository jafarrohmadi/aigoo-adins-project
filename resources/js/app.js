import "alpinejs";

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

var nav = {
    width: 990,
    make() {
        return {
            collapsed: function() {
                if (window.innerWidth < this.width) {
                    return true;
                }

                return false;
            },
            resize() {
                if (window.innerWidth < this.width) {
                    this.collapsed = true;
                }
            },
            click() {
                this.collapsed = !this.collapsed;
                if (!this.collapsed) {
                    this.$refs.body.classList.add("sidebar-collapse");
                } else {
                    this.$refs.body.classList.remove("sidebar-collapse");
                }
            },
            clickAway() {
                if (window.innerWidth < this.width) {
                    this.$refs.body.classList.remove("sidebar-collapse");
                    this.collapsed = true;
                }
            },
        };
    },
};

window.nav = nav;
