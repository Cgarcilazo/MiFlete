'use strict';

export const handleResponseErrors = (errors) => {
  let errorList = [];

  for (let value of Object.values(errors)) {
    errorList = errorList.concat(value.map(v => v));
  }

  return errorList;
}

export default {
  handleResponseErrors,
}