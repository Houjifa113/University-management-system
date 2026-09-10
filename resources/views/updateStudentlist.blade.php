<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <h2>Update Student Information</h2>
  <p>Change only the fields you want. Leave a field blank to keep its current value.</p>
  @php($isStudent = Auth::guard('student')->check())

  <form action="{{ route('student.profile.update', $studentlist) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @if (! $isStudent)
    <div class= "input-form">
         <input type="text" placeholder="Username" name="username" value="{{ old('username', $studentlist->username) }}">
         @error('username') <span style="color: red">{{ $message }}</span> @enderror
    </div>

    <div class= "input-form">
         <input type="email" placeholder="Email" name="email" value="{{ old('email', $studentlist->email) }}">
         @error('email') <span style="color: red">{{ $message }}</span> @enderror
    </div>
    @endif

    <div class= "input-form">
         <input type="password" placeholder="New Password (leave blank to keep current password)" name="password">
         <input type="password" placeholder="Confirm New Password" name="password_confirmation">
         @error('password') <span style="color: red">{{ $message }}</span> @enderror
    </div>

    @if (! $isStudent)
     <div class= "input-form">
          <label>Gender:</label>
           <div class="field_box">
          <input type="radio" name="gender" value="Male" id="male" {{ old('gender', $studentlist->gender) == 'Male' ? 'checked' : '' }}>
          <lebel for="male">Male </lebel>
          
          <input type="radio" name="gender" value="Female" id="female" {{ old('gender', $studentlist->gender) == 'Female' ? 'checked' : '' }}>
          <lebel for="female">Female </lebel>

          <input type="radio" name="gender" value="Other" id="other" {{ old('gender', $studentlist->gender) == 'Other' ? 'checked' : '' }}>
          <lebel for="other">Other </lebel>       
          </div>
          @error('gender') <span style="color: red">{{ $message }}</span> @enderror
    </div>
     <div class="input_field">
            <label>Department:</label>
            <div class="field_box">
              <select name="designation" id="designation">
                <option value="Not Selected">Select</option>
                <option value="SWE" {{ old('designation', $studentlist->department) == 'SWE' ? 'selected' : '' }}>SWE</option>
                <option value="BA" {{ old('designation', $studentlist->department) == 'BA' ? 'selected' : '' }}>BA</option>
                <option value="PM" {{ old('designation', $studentlist->department) == 'PM' ? 'selected' : '' }}>PM</option>
              </select>
              @error('designation') <span style="color: red">{{ $message }}</span> @enderror
     </div>
    @endif

     <div class= "input-form">
         <label>Image:</label>
         @if($studentlist->image)
             <img src="{{ asset('storage/' . $studentlist->image) }}" width="100" height="100">
         @else
             No Image
         @endif
     </div>   
      


    <div class= "input-form">
         <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif">
         @error('image') <span style="color: red">{{ $message }}</span> @enderror
    </div>

    <div class= "input-form">
         <button>Update</button>
    </div>      
         
    </div>
  </form>
  @if ($isStudent)
    <a href="{{ route('student.profile', $studentlist->id) }}"><button type="button">Back to Profile</button></a>
  @else
    <a href="{{ route('studentlist', ['sort' => 'department', 'page' => 1]) }}"><button type="button">Back to Student List</button></a>
  @endif
</div>


<style >

  input {
    color: Black;
    border: 1px solid;
    height: 35px;
    width: 200px;
    margin: 10px;
}
</style>
</body>
</html>
