Rails.application.routes.draw do
  get 'welcome/index'
  # For details on the DSL available within this file, see http://guides.rubyonrails.org/routing.html
  get 'welcome/index'
  get 'welcome/show'
  post 'welcome/showA'
get 'product/manage_product'

  root 'welcome#index'
end
