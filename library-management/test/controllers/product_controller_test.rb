require 'test_helper'

class ProductControllerTest < ActionDispatch::IntegrationTest
  test "should get manage_product" do
    get product_manage_product_url
    assert_response :success
  end

end
