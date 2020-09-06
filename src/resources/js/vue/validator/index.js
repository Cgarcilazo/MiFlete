'use strict';

import { extend } from 'vee-validate';
import { required, email, confirmed } from 'vee-validate/dist/rules';

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

export default {
  requiredRule,
  emailRule,
  confirmedRule,
}