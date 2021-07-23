import { extend } from 'vee-validate'
import { email, min, required, max, confirmed } from 'vee-validate/dist/rules'

extend('required', {
  ...required,
  message: 'This field is required'
})

extend('email', {
  ...email,
  message: 'enter the format of the email'
})

extend('min', {
  ...min,
  message: 'Please enter at least 6 characters'
})

extend('max', {
  ...max,
  message: 'Please enter 20 characters or less'
})

extend('confirmed', {
  ...confirmed,
  message: 'please enter same password'
})
