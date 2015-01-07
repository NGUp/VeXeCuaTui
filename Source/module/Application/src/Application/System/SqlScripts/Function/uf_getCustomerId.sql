-- Lấy mã khách hàng
--
-- uf_getCustomerID()

Create Function uf_getCustomerID()
	Returns varchar(10)
As
Begin
	Declare @customerId nchar(10),
			@seat char(2),
			@position int

    Set @customerId = CONVERT(NVARCHAR(50),HashBytes('SHA1', Cast(SYSDATETIME() as varchar(30))), 2)
    Set @customerId = SUBSTRING(@customerId, 1, 7)

    Return @customerId
End