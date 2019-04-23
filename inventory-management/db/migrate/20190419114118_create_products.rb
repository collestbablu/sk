class CreateProducts < ActiveRecord::Migration[5.2]
  def change
    create_table :products do |t|
      t.string :sku_no
      t.text :product_name
      t.integer :price

      t.timestamps
    end
  end
end
