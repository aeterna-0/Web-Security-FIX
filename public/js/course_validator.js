function unlockContent() {
  let code = document.getElementById("access_code").value;
  let resultDiv = document.getElementById("challenge-result");

  fetch("verify_code.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "code=" + encodeURIComponent(code)
  })
    .then(response => response.json())
    .then(data => {
      if (data.ok) {
        let contentHTML = `
          <div style="border: 1px solid var(--accent-blue); padding: 15px; border-radius: 5px; background-color: var(--light-navy);">
            <h3 style="color: var(--accent-blue);">ACCESS GRANTED</h3>
            <p style="color: var(--lightest-slate); margin-top:10px;">
              Excellent work. You've demonstrated why client-side checks should never be trusted for security.
            </p>
            <p style="font-weight: 700; color: var(--accent-blue); margin-top:10px;">
              ${data.secret}
            </p>
          </div>
        `;
        resultDiv.innerHTML = contentHTML;
      } else {
        alert(data.msg || "Incorrect Code.");
      }
    })
    .catch(() => {
      alert("Terjadi kesalahan saat memverifikasi kode.");
    });
}