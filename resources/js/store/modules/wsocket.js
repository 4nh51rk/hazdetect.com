import main from "../../app";

export const wsocket = {
  state: {
    socket: {
      isConnected: false,
      message: "",
      reconnectError: false,
    },
  },
  mutations: {
    SOCKET_ONOPEN(state, event) {
      main.config.globalProperties.$socket = event.currentTarget;
      state.socket.isConnected = true;
    },
    SOCKET_ONCLOSE(state, event) {
      state.socket.isConnected = false;
      state.socket.message = "";
    },
    SOCKET_ONERROR(state, event) {
      console.error(state, event);
    },
    // default handler called for all methods
    SOCKET_ONMESSAGE(state, message) {
      state.socket.message = message;
    },
    // mutations for reconnect methods
    SOCKET_RECONNECT(state, count) {
      console.info(state, count);
    },
    SOCKET_RECONNECT_ERROR(state) {
      state.socket.reconnectError = true;
    },
  },
};
