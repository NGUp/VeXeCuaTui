-- Thêm một manager vào QuanTriVien
--
-- usp_createManager '888999654', 'Harry James', 'james', 'MLE'
-- usp_createManager '888999654', 'Harry James', 'james', 'MLE'

Create Procedure usp_createManager (
    @id nchar(10),
    @name nvarchar(50),
    @user varchar(50),
    @operator nchar(10)
)
As
Begin
    Declare @pass varchar(50)

    Set @pass = dbo.uf_encodePassword(@user, '123456', 'True')

    Insert Into QuanTriVien(CMND, HoTen, TenDangNhap, MatKhau, QuanTriVien, HangXe)
    Values(@id, @name, @user, @pass, 'False', @operator)
End