function validEmail(sp_image)
{
	// Regular expression which describes a valid email address (e.g email@domain.suffix)
	var regex = /<img\s[^>]*?src\s*=\s*['\"]([^'\"]*?)['\"][^>]*?>;

	// Evaluates to true if the given value meets the conditions of the regular expression.
  	return regex.test(sp_image);
}
