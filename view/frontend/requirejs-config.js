/**
 * @author Maciej Sławik <maciekslawik@gmail.com>
 */

var config = {
  map: {
    '*': {
      'sampleWidget': 'MSlwk_Sample/js/sampleWidget',
    },
  },
  config: {
    mixins: {
      'Magento_Theme/js/view/breadcrumbs': {
        'MSlwk_Sample/js/view/breadcrumbs': true,
      },
      'Magento_Ui/js/lib/validation/validator': {
        'MSlwk_Sample/js/validator-mixin': true,
      },
      'Magento_Checkout/js/action/select-shipping-method' : {
        'MSlwk_Sample/js/action/select-shipping-method-wrapper': true
      },
    },
  },
  deps: [
    'MSlwk_Sample/js/everyPageRun',
  ],
};
