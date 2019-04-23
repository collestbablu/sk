class ProductController < ApplicationController
  def manage_product
  	 @products = Product.all
  end
  def add_product
  end

  

end
