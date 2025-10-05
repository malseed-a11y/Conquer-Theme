document.addEventListener("DOMContentLoaded", () => {
  const forms = document.querySelectorAll(".special-form");

  forms.forEach((form) => {
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      const formTableName = form.querySelector(
        'input[type="hidden"][name="table_name"]'
      )?.value;

      const tableBody = document.querySelector(
        `.special-table[data-type="${formTableName}"] tbody`
      );

      console.log(tableBody);
      const formData = new FormData(form);
      formData.append("action", "send_comment_form");
      formData.append("_ajax_nonce", my_ajax_obj.nonce);

      try {
        const response = await fetch(my_ajax_obj.ajax_url, {
          method: "POST",
          body: formData,
        });

        const result = await response.json();

        if (result.success) {
          form.reset();

          if (tableBody) {
            tableBody.insertAdjacentHTML("beforeend", result.data.row_html);
          }
        } else {
          console.error("AJAX error:", result.data);
        }
      } catch (err) {
        console.error("Fetch error:", err);
      }
    });
  });
});
