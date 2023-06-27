module.exports = function (api) {
    api.cache(true);

    return {
        presets: undefined,
        plugins: ['macros'],
    }
}
  