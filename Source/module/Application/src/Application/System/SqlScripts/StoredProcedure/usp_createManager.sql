-- Thêm một manager vào QuanTriVien
--
-- usp_createManager '888999654', 'Harry James', 'james', 'yes', 'MLE'
-- usp_createManager '888999654', 'Harry James', 'james', NULL, 'MLE'

Create Procedure usp_createManager (
    @id nchar(10),
    @name nvarchar(50),
    @user varchar(50),
    @status char(3),
    @operator nchar(10)
)
As
Begin
    Declare @pass varchar(50)

    If @status Is Not Null
    Begin
        Set @operator = Null
    End

    Set @pass = dbo.uf_encodePassword(@user, '123456', 'True')

    Insert Into QuanTriVien(CMND, HoTen, TenDangNhap, MatKhau, NgayTao, HangXe)
    Values(@id, @name, @user, @pass, GETDATE(), @operator)
End