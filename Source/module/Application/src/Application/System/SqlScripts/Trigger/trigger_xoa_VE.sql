Create Trigger trigger_xoa_VE On Ve For Delete
As
	Declare @id varchar(10)

	Select @id = KhachHang
	From Deleted

	If Not Exists (Select MaVe From Ve Where KhachHang = @id)
	Begin
		Delete From KhachHang Where MaKH = @id
	End