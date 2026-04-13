<?php $__env->startSection('admin-content'); ?>
<div class="space-y-6">
  <!-- Header -->
  <div class="flex justify-between items-center">
    <div>
      <h2 class="text-2xl font-bold text-slate-900">Profil Lembaga</h2>
      <p class="text-slate-600">Kelola visi, misi, dan struktur organisasi.</p>
    </div>
    <button onclick="saveChanges()" class="flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700">
      <i class="ph ph-floppy-disk text-base leading-none"></i> Simpan Perubahan
    </button>
  </div>

  <!-- Profile Form -->
  <div class="bg-white rounded-2xl border border-slate-100 shadow-xl p-6">
    <div class="space-y-6">
      <!-- Organization Name -->
      <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lembaga</label>
        <input
          type="text"
          value="<?php echo e($organization['name']); ?>"
          oninput="updateOrganization('name', this.value)"
          class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
        />
      </div>

      <!-- Vision -->
      <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Visi</label>
        <textarea
          value="<?php echo e($organization['vision']); ?>"
          oninput="updateOrganization('vision', this.value)"
          rows="3"
          class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
        ></textarea>
      </div>

      <!-- Mission -->
      <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Misi</label>
        <textarea
          value="<?php echo e($organization['mission']); ?>"
          oninput="updateOrganization('mission', this.value)"
          rows="4"
          class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
        ></textarea>
      </div>

      <!-- Description -->
      <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Lembaga</label>
        <textarea
          value="<?php echo e($organization['description']); ?>"
          oninput="updateOrganization('description', this.value)"
          rows="5"
          class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
        ></textarea>
      </div>

      <!-- Contact Info -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
          <input
            type="email"
            value="<?php echo e($organization['email']); ?>"
            oninput="updateOrganization('email', this.value)"
            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
          />
        </div>
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Telepon</label>
          <input
            type="tel"
            value="<?php echo e($organization['phone']); ?>"
            oninput="updateOrganization('phone', this.value)"
            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
          />
        </div>
      </div>

      <!-- Address -->
      <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat</label>
        <textarea
          value="<?php echo e($organization['address']); ?>"
          oninput="updateOrganization('address', this.value)"
          rows="3"
          class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
        ></textarea>
      </div>

      <!-- Social Media -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Facebook</label>
          <input
            type="url"
            value="<?php echo e($organization['social']['facebook']); ?>"
            oninput="updateSocial('facebook', this.value)"
            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
          />
        </div>
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Instagram</label>
          <input
            type="url"
            value="<?php echo e($organization['social']['instagram']); ?>"
            oninput="updateSocial('instagram', this.value)"
            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
          />
        </div>
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Twitter</label>
          <input
            type="url"
            value="<?php echo e($organization['social']['twitter']); ?>"
            oninput="updateSocial('twitter', this.value)"
            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
          />
        </div>
      </div>
    </div>
  </div>

  <!-- Team Members -->
  <div class="bg-white rounded-2xl border border-slate-100 shadow-xl p-6">
    <div class="flex justify-between items-center mb-6">
      <h3 class="text-lg font-bold text-slate-900">Tim Pengurus</h3>
      <button onclick="addTeamMember()" class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200">
        <span>+</span> Tambah Anggota
      </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="border border-slate-200 rounded-xl p-4">
          <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-lg font-bold">
              <?php echo e(substr($member['name'], 0, 1)); ?>

            </div>
            <div class="flex-1">
              <h4 class="font-semibold text-slate-900"><?php echo e($member['name']); ?></h4>
              <p class="text-sm text-slate-600"><?php echo e($member['position']); ?></p>
              <p class="text-sm text-slate-500"><?php echo e($member['email']); ?></p>
            </div>
            <div class="flex gap-1">
              <button onclick="editTeamMember(<?php echo e($member['id']); ?>)" class="p-1 text-slate-400 hover:text-emerald-600"><i class="ph ph-pencil-simple text-base"></i></button>
              <button onclick="deleteTeamMember(<?php echo e($member['id']); ?>)" class="p-1 text-slate-400 hover:text-red-600"><i class="ph ph-trash text-base"></i></button>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>

<script>
  let organization = <?php echo json_encode($organization, 15, 512) ?>;

  function updateOrganization(field, value) {
    organization[field] = value;
  }

  function updateSocial(platform, value) {
    organization.social[platform] = value;
  }

  function saveChanges() {
    // Save organization data
    console.log('Saving:', organization);
  }

  function addTeamMember() {
    // Add team member
  }

  function editTeamMember(id) {
    // Edit team member
  }

  function deleteTeamMember(id) {
    if (confirm('Hapus anggota tim ini?')) {
      // Delete team member
    }
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Magang\PT. YMP\fundunity\resources\views/admin/aboutus.blade.php ENDPATH**/ ?>