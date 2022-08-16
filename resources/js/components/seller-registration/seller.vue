<template>
  <body>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="page w-screen h-screen">
      <div id="site-banner"></div>
      <div class="site-logo flex justify-center items-center sm:pl-10 sm:py-1">
        <img @click="goHome" src="assets/logo.png" alt="Creative Market" class="cursor-pointer sm:h-14 h-12">
      </div>
      <div class="flex justify-center items-center sm:h-screen sm:w-screen z-0">
        <div class="p-8 p-4 bg-white border-0 sm:border-2 sm:border-gray-200 shadow-none sm:shadow-md rounded-lg seller-form seller-form__registration ">
          <div class="w-full">
            <div class="flex" v-if="step !== 3">
              <span class="seller-form__text--uppercase">Seller Application</span>
              <span class="seller-form__steps-text flex-grow">STEP {{step}} OF 2</span>
            </div>

            <!-- STEP 1 -->          
            <div v-if='step === 1'>
              <div class="seller-form__title mt-2">Share your work with us</div>
              <div class="seller-form__info-text my-4">To ensure the quality of our marketplace, we limit our seller community to the most qualified creators. Let our curators know why you'd be a great seller:</div>
              
              <div class="flex mb-6">
                <span class="flex-grow mr-4">
                  <label class="block font-bold mb-2 form seller-form__registration" for="first_name">
                    First Name <span v-if="errors && !sellerForm.first_name" class="seller-form_required">(Required)</span>
                  </label>
                  <input v-model.trim="sellerForm.first_name" class="w-full shadow appearance-none seller-form__input py-2 px-3 leading-tight"
                            id="first_name"
                            type="text"
                            :class="{inputError: !sellerForm.first_name && this.errors}">
                </span>

                <span class="flex-grow sm:mr-4">
                  <label class="block font-bold mb-2 seller-form__registration" for="last_name">
                    Last name <span v-if="errors && !sellerForm.last_name" class="seller-form_required">(Required)</span>
                  </label>
                  <input v-model.trim="sellerForm.last_name"
                            class="w-full shadow appearance-none seller-form__input py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"
                            id="last_name"
                            type="text"
                            :class="{inputError: !sellerForm.last_name && this.errors}">
                </span>
              </div>
              <div class="flex-grow mb-6 sm:mr-4">
                <label class="block font-bold mb-2 seller-form__registration" for="category">
                  Your Shop Category <span v-if="errors && !sellerForm.category" class="seller-form_required">(Required)</span>
                </label>
                <select v-model="sellerForm.category" class="seller-form__input w-full py-2 px-3 text-base" name="category" id="category" :class="{inputError: !sellerForm.category && this.errors}">
                  <option value="" disabled selected>Select Category</option>
                  <option v-for="opt in dropDownText.category" :key="opt.id" v-bind:value="opt.id">{{ opt.text }}</option>
                </select>
              </div>

              <div class="flex-grow mb-6 sm:mr-4">
                <label class="block font-bold mb-2 seller-form__registration" for="portfolio">
                  Portfolio Link 
                  <span v-if="errors && !sellerForm.portfolio" class="seller-form_required">(Required)</span> 
                  <span v-if="portfolioExists" class="seller-form_required">({{ portfolioError }})</span>
                </label>
                <input v-model.trim="sellerForm.portfolio" @blur="checkPortfolio" class="w-full shadow appearance-none seller-form__input py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" id="portfolio" type="text" :class="{inputError: sellerForm.portfolio === '' && sellerForm.confirm_portfolio || this.errors && sellerForm.portfolio === ''}">
                <div class="mt-2 flex items-center">
                  <input v-model.trim="sellerForm.confirm_portfolio" type="checkbox" id="confirm-content" name="confirm-content" class="seller-form__checkbox" :class="{inputError: sellerForm.portfolio && !sellerForm.confirm_portfolio}">
                  <label for="confirm-content" class="ml-2 seller-form__info-text">Yes, I confirm that the content I submit is authored by me.</label> <span v-if="errors && !sellerForm.confirm_portfolio" class="seller-form_required">(Required)</span>
                </div>
              </div>

              <div class="flex-grow mb-6">
                <label class="block font-bold mb-2 seller-form__registration" for="stores">
                  Do you already have an online store? <span v-if="errors && sellerForm.has_online_stores === null" class="seller-form_required">(Required)</span>
                </label>
                <div class="mb-2 flex items-center">
                  <input v-model.number="sellerForm.has_online_stores" value=1 type="radio" id="yes" name="existing-store" class="seller-form__radio-button" :class="{inputError: sellerForm.has_online_stores && this.errors}">
                  <label for="yes" class="seller-form__info-text ml-2">Yes</label>
                </div>
                <div class="mb-2 flex items-center">
                  <input v-model.number="sellerForm.has_online_stores" value=0 type="radio" id="no" name="existing-store" class="seller-form__radio-button">
                  <label for="no" class="seller-form__info-text ml-2">No</label>
                </div>
              </div>

              <div v-if="sellerForm.has_online_stores" class="sm:mr-4">
                <label class="block font-bold mb-2 seller-form__registration" for="online-stores">
                  Online stores I sell on today <span v-if="errors && !sellerForm.online_stores" class="seller-form_required">(Required)</span>
                </label>
                <textarea v-model="sellerForm.online_stores" name="online_stores" id="online-stores" placeholder="Enter urls" cols="30" rows="4" class="w-full seller-form__input p-4 mr-4" :class="{inputError: !sellerForm.online_stores && this.errors}"></textarea>
              </div>

              <div class="flex justify-between mt-6">
                <div></div>
                <button class="seller-form__button text-white py-2 px-6 rounded focus:outline-none focus:shadow-outline" type="button" @click="nextStep">
                  Next
                </button>
              </div>    
            </div>

            <!-- STEP 2 -->
            <div v-if='step === 2'>
              <div class="seller-form__title mt-2">Tell us a little about yourself</div>
              <div class="seller-form__info-text my-4">Your answers will help us provide you with a more personalized experience as a seller!</div>

              <div class="flex-grow mb-6 sm:mr-4">
                <label class="block font-bold mb-2 seller-form__registration" for="category">
                  When creating product to sell, which best describes your perspective on quality? <span v-if="errors && !sellerForm.perspective" class="seller-form_required">(Required)</span>
                </label>
                <select v-model="sellerForm.perspective" class="seller-form__input w-full py-2 px-3 text-base" name="category" id="category" :class="{inputError: !sellerForm.perspective && this.errors}">
                  <option value="" disabled selected>Select Answer</option>
                  <option v-for="opt in dropDownText.perspective" :key="opt.id" v-bind:value="opt.id">{{ opt.text }}</option>
                </select>
              </div>

              <div class="flex-grow mb-6 sm:mr-4">
                <label class="block font-bold mb-2 seller-form__registration" for="category">
                  How would you describe your experience level as an online seller? <span v-if="errors && !sellerForm.experience" class="seller-form_required">(Required)</span>
                </label>
                <select v-model="sellerForm.experience" class="seller-form__input w-full py-2 px-3 text-base" name="category" id="category" :class="{inputError: !sellerForm.experience && this.errors}">
                  <option value="" disabled selected>Select Answer</option>
                  <option v-for="opt in dropDownText.experience" :key="opt.id" v-bind:value="opt.id">{{ opt.text }}</option>
                </select>
              </div>

              <div class="flex-grow mb-6 sm:mr-4">
                <label class="block font-bold mb-2 seller-form__registration" for="category">
                  How would you describe your understanding of business and marketting? <span v-if="errors && !sellerForm.understanding" class="seller-form_required">(Required)</span>
                </label>
                <select v-model="sellerForm.understanding" class="seller-form__input w-full py-2 px-3 text-base" name="category" id="category" :class="{inputError: !sellerForm.understanding && this.errors}">
                  <option value="" disabled selected>Select Answer</option>
                  <option v-for="opt in dropDownText.understanding" :key="opt.id" v-bind:value="opt.id">{{ opt.text }}</option>
                </select>
              </div>

              <!-- <div class="flex justify-center sm:justify-between sm:mr-4"> -->
              <div class="flex justify-between items-center flex-col sm:flex-row">
                <div class="order-1 sm:order-2 w-full sm:w-auto">
                  <button class="seller-form__button text-white py-2 rounded focus:outline-none sm:mr-4 w-full sm:w-auto" type="button" @click="nextStep">
                    Submit Application
                  </button>
                </div>
                <div class="order-2 sm:order-1 mt-8 sm:mt-0">
                  <button class="seller-form__button--back rounded focus:outline-none focus:shadow-outline" type="button" @click="prevStep">
                    <i class="fas fa-chevron-left"></i> Back
                  </button>
                </div>
              </div>
            </div>

            <!-- CONFIRMATION PAGE  -->
            <div v-if='step === 3'>
              <div class="items-center justify-center">
                <div class="flex items-center justify-center">
                      <img src="/assets/icon-sent.png" alt="" class="seller-form__confirmation-image">
                </div>
                <div class="seller-form__confirmation-title">
                  Thank you for applying to become a seller!
                </div>
                <div class="seller-form__confirmation-body mb-20">
                  Our curators are reviewing your application. We'll get back to you within <span class="seller-form__text-bold">5-7 business days</span>. Meanwhile, you already have access to your Shop Studio, so let's start setting up your shop!
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</template>

<script>
import axios from 'axios';

export default {
  name: 'sellerRegistration',
  data() {
    return {
          radio: null,
          sellerForm: {
            first_name: null,
            last_name: null,
            portfolio: '',
            confirm_portfolio: false,
            online_stores: null,
            has_online_stores: null,
            category: '',
            perspective: '',
            experience: '',
            understanding: ''
          },
          errors: 0,
          showOnlineStores: false,
          portfolioExists: null,
          portfolioError: null,
        }
  },
  computed: {
    dropDownText: {
      get: function() {
        return this.$store.getters.getDropDowns;
      },
      set: function() {
      }
    },
    step: {
      get: function() {
        return this.$store.getters.getStep;
      },
      set: function(value) {
      },
    },
  },
  mounted() {
    this.$store.dispatch('setDropDowns')
  },
  methods: {
    checkPortfolio : function() {
      if(!this.sellerForm.portfolio) return;

      try {
        axios.get('api/sellers/check-existing-portfolio/?portfolio=' + this.sellerForm.portfolio)
        .then(response => {
          if(response.status === 200) {
            if(response.data) {
              this.portfolioExists = true;
              this.portfolioError = response.data.portfolio[0];
              return
            }
              this.portfolioExists = false;
              this.portfolioError = null;
          }
        })
        .catch((error) => {
          // Log errors
        });
      } catch (err) {
        // Log errors
      }
    },
    submitSellerApplication : function() {
      try {
        axios.post('/api/sellers/seller', this.sellerForm)
          .then(response => {
            if(response.status === 201) {
              this.$store.dispatch('setStep', this.step+1)
            }
          })
          .catch ((err) => {
            // log errors
         })
      } catch (err) {
        // log errors
      }
    },
    validate: function() {
      this.errors = 0;
      if(this.step === 1){
        this.portfolioExists ? this.errors++ : '';
        !this.sellerForm.first_name ? this.errors++ : '';
        !this.sellerForm.last_name ? this.errors++ : '';
        !this.sellerForm.category ? this.errors++ : '';
        !this.sellerForm.portfolio ? this.errors++ : '';
        !this.sellerForm.confirm_portfolio ? this.errors++ : '';

        if(this.sellerForm.has_online_stores) {
          !this.sellerForm.online_stores ? this.errors++ : '';
        } else if(this.sellerForm.has_online_stores=== null) {
          this.errors++;
        } else {
          this.sellerForm.online_stores = null;
        }
      }

      if(this.step === 2){
         !this.sellerForm.perspective ? this.errors++ : '';
         !this.sellerForm.experience ? this.errors++ : '';
         !this.sellerForm.understanding ? this.errors++ : '';
      }

    },
    goHome: function() {
      window.location.href = "/"
    },
    nextStep: function() {
      this.validate();
      if(this.step === 1){
        if(this.errors <= 0) {
          this.$store.dispatch('setStep', this.step+1)
         return
        }
      }

      if(this.step === 2){
        if(this.errors <= 0) {
          this.submitSellerApplication();
         return
        }
      }

    },
    prevStep: function() {
      this.$store.dispatch('setStep', this.step-1)
    },
  }
}
</script>

<style scoped>
body {
  font-family: Helvetica,sans-serif;
  font-size: 20px;
}

@media screen and (min-width: 980px) {
  #site-banner {
    border-bottom: 4px solid rgb(136 162 75);
      box-shadow: 0 1px 1px rgb(0 0 0 / 11%);
      position: relative;
      width: 100%;
  }
}

.site-logo {
  float: left;
}

@media screen and (max-width: 980px) {
  .site-logo  {
      float: none;
      background-color: var(--header_background);
      box-shadow: 0 2px 4px -1px rgba(0,0,0,0.25);
      backface-visibility: hidden;
  }
}

@media screen and (min-width: 768px) {
  .header {
    margin-bottom: 20px;
    padding: 15px 0 0 56px;
  }
}
@media only screen and (min-width: 600px) {
  .page {
    background-image: url('/assets/bg-pattern.png');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: bottom;
    background-size: 100% 50%;
  }
}

.seller-form {
  width: 650px;
}

.seller-form_error {
  color: #790b0b;
}

.inputError {
  border: 2px solid #790b0b !important;
}

.seller-form__registration {
  font-size: .8rem;
}

.seller-form__confirmation{
    background-image: url('/assets/icon-sent.png');
}
.seller-form__confirmation-image{
  width: 150px;
}
.seller-form__confirmation-title{
  font-size: 1.6rem;
  text-align: center;
  font-weight: 400;
  margin: 20px 0;
}

.seller-form__confirmation-body{
  font-size: 1rem;
  text-align: center;
  font-weight: 100;
}

.seller-form__text--uppercase {
  text-transform: uppercase;
}

.seller-form__title {
  font-size: 1.5rem;
  font-weight: 500;
}

.seller-form__info-text {
  font-size: .9rem;
}

.seller-form__text-bold{
  font-weight: 600;
}
.seller-form__radio-button {
  color: #088178;
}

.seller-form__steps-text {
  font-size: .7rem;
  text-align: right;
}

.seller-form__button {
  font-size: 18px;
  background-color: #088178;
  padding: 0.9rem 4rem;
}

.seller-form__button:hover {
  background-color: #096b65;
  padding: 0.9rem 4rem;
}

.seller-form__button--back {
  font-size: 18px;
  color: #088178;
  background-color: #fff;
}

.seller-form__checkbox {
  margin-top: .2rem;
}
.seller-form__checkbox:checked {
  background-color: #088178;
}

.seller-form__input {
  background: #fbfbfd;
  border: 1px solid #899298;
  box-shadow: none;
  background-color: rgb(251, 251, 253);
  border-radius: 0.25rem;
  line-height: 1.4;
  color: #343a3d;
  border-radius: 3px;
  margin: 0;
}

.seller-form_required {
  font-weight: bold;
  color: #790b0b
}

.centered {
  display: flex;
  width: 100vw;
  justify-content: center;
  align-items: center;
}
</style>
