module.exports = {
  methods: {
      /**
       * Translate the given key.
       * 
       * @param {string} key
       * @param {object} replace [optional] Object with placeholders (keys) and replacements (values)
       * @param {number} number [optional] Refers to pluralization
       * @returns {string}
       */
      __(key, replace = {}, number) {
        if(undefined !== number) return this.__n(key, number, replace)
        const keys = /\s|[.]$/.test(key) ? [key] : key.split('.');
        let translation = this.$page.props.language;

        keys.forEach(keyT => {
          translation =  translation[keyT] ?? keyT       
        });

        translation = this.__r(translation, replace)

        return translation
      },

      /**
       * Translate the given key with basic pluralization.
       * 
       * @param {string} key
       * @param {number} number Refers to pluralization
       * @param {object} replace [optional] Object with placeholders (keys) and replacements (values)
       * @returns {string}
       */
      __n(key, number, replace = {}) {
        key = this.__(key, replace)
        var options = key.split('|');
        key = number == 1 ? options[0] : options[1];
        return this.__r(key, replace);
      },

      /**
       * Replace placeholders in string
       * 
       * @param {string} source String to convert
       * @param {object} replace Object with placeholders (keys) and replacements (values)
       * @returns {string} String converted
       */
      __r(source, replace = {}) {
        Object.keys(replace).forEach(key => {
          source = source.replace(':' + key, replace[key])
        });
        return source
      }
  },
}