class Mycalss
   
   def evenOdd( )
      	a=10
		if(a % 2==0)
			puts("#{a} is even Number ")
		else
 			puts("#{a} is odd")
 		end
   end

   def graterThen
  		a=10
  		b=20
  		c=5
  		if a>b and a>c
  			puts("#{a} is greater")
  		elsif(b>a and b>c)
  			puts("#{b} is greater")
  		else
  			puts("#{c} is greater")
  		
  		end	
   end


   def forloop()
   		/for i in 0..10
   			puts(i)
   		end
/
   		/i=0 and while(i<20) do
		puts i+=1
		end/
		for j in 1..5 do
     	for i in 1..5 do
         print i,  " "
         break if i == 2
    end
	end
   	
   	end		

   def add1( )
    @b = 20
    puts(@b)
   end
 
end

# Create a new object
myObj = Mycalss.new()
# Output "Hello Ruby!"
myObj.evenOdd
myObj.graterThen
myObj.forloop