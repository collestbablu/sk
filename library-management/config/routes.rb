Rails.application.routes.draw do
  get 'product/manage_product'
  get 'product/add_product'
 
  # For details on the DSL available within this file, see http://guides.rubyonrails.org/routing.html
root 'product#manage_product'
end
