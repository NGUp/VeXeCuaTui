Create Trigger trigger_xoa_XE On XE For Delete
As
	Declare @id varchar(10)

	Select @id = BangSoXe
	From Deleted

	Delete From Ve Where Xe = @id