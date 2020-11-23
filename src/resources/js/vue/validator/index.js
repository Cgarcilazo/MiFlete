'use strict';

import { extend } from 'vee-validate';
import { required, email, confirmed, decimal } from 'vee-validate/dist/rules';

// Add the required rule
export const requiredRule = extend('required', {
  ...required,
  message: 'Este campo es requerido'
});

// Add the email rule
export const emailRule = extend('email', {
  ...email,
  message: 'Ingrese un email válido'
});

// Add the confirmed rule
export const confirmedRule = extend('confirmed', {
  ...confirmed,
  message: 'El valor de confirmación no es el mismo'
});

// Add the required rule
export const decimalRule = extend("decimal", {
  validate: (value, { decimals = '*', separator = '.' } = {}) => {
    if (value === null || value === undefined || value === '') {
      return {
        valid: false
      };
    }
    if (Number(decimals) === 0) {
      return {
        valid: /^-?\d*$/.test(value),
      };
    }
    const regexPart = decimals === '*' ? '+' : `{1,${decimals}}`;
    const regex = new RegExp(`^[-+]?\\d*(\\${separator}\\d${regexPart})?([eE]{1}[-]?\\d+)?$`);

    return {
      valid: regex.test(value),
    };
  },
  message: 'Ingrese valores decimales separados por un punto'
})

export default {
  requiredRule,
  emailRule,
  confirmedRule,
  decimalRule,
}