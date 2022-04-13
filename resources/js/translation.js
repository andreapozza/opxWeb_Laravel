module.exports = {
  methods: {
      /**
       * Translate the given key.
       */
      __(key, replace = {}, number) {
        if(number) return this.__n(key, number, replace)
        const keys = key.split('.');
        let translation = this.$page.props.language;
        keys.forEach(keyT => translation = translation[keyT] ?? keyT);

        Object.keys(replace).forEach(keyT => {
          translation = translation.replace(':' + keyT, replace[keyT])
        });

        return translation
      },

      /**
       * Translate the given key with basic pluralization.
       */
      __n(key, number, replace = {}) {
        var options = key.split('|');
        key = number == 1 ? options[0] : options[1];
        return this.__(key, replace);
      },
  },
}