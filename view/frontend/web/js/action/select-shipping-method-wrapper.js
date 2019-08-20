/**
 * @author Maciej Sławik <maciekslawik@gmail.com>
 */

define([
  'mage/utils/wrapper',
], function(wrapper) {
  'use strict';

  return function(selectShippingMethodAction) {
    return wrapper.wrap(selectShippingMethodAction, function(originalAction) {
      console.log('selectShippingMethodAction was called');
      return originalAction();
    });
  };
});