@extends('layouts.medical')

@section('title', 'Modifier mon profil · SynergyAI')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('patient.medical-record') }}" class="text-warm-gray hover:text-primary transition">
            <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-3xl font-display font-bold text-primary">Modifier mon profil</h1>
    </div>

    <!-- Messages flash -->
    @if(session('success'))
        <div class="p-4 bg-soft-green/60 backdrop-blur-sm rounded-2xl border border-green-200/50 text-green-700 text-sm flex items-center gap-2 mb-4">
            <i class="fas fa-check-circle text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="glass-card p-6 md:p-8">

        <form method="POST" action="{{ route('patient.medical-record.update') }}" enctype="multipart/form-data" 
              x-data="{
                  photoPreview: '{{ $user->photo_profil ? asset('storage/' . $user->photo_profil) : '' }}',
                  photoName: '{{ $user->photo_profil ? basename($user->photo_profil) : 'Aucun fichier' }}',
                  handlePhoto(e) {
                      const file = e.target.files[0];
                      if (file) {
                          this.photoName = file.name;
                          const reader = new FileReader();
                          reader.onload = (ev) => this.photoPreview = ev.target.result;
                          reader.readAsDataURL(file);
                      }
                  }
              }">
            @csrf
            @method('PUT')

            <!-- Photo de profil -->
            <div class="flex flex-col items-center mb-6">
                <div class="relative">
                    <img :src="photoPreview || '{{ asset('images/default-avatar.png') }}'" 
                         alt="Photo de profil" 
                         class="w-28 h-28 rounded-full object-cover border-4 border-white shadow-lg">
                    <label for="photo_profil" class="absolute bottom-0 right-0 w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center cursor-pointer shadow-md hover:bg-primary-light transition">
                        <i class="fas fa-camera text-sm"></i>
                    </label>
                    <input type="file" id="photo_profil" name="photo_profil" accept="image/*" class="hidden" @change="handlePhoto($event)">
                </div>
                <p class="text-xs text-warm-gray/60 mt-2" x-text="photoName"></p>
                <p class="text-xs text-warm-gray/40 mt-1">PNG, JPG, WEBP · max 2 Mo</p>
                @error('photo_profil') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- 2 colonnes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- Prénom -->
                <div>
                    <label for="prenom" class="block text-sm font-medium text-warm-gray">Prénom <span class="text-red-500">*</span></label>
                    <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}" required
                           class="input-field w-full mt-1" placeholder="Jean">
                    @error('prenom') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-medium text-warm-gray">Nom <span class="text-red-500">*</span></label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom', $user->nom) }}" required
                           class="input-field w-full mt-1" placeholder="Dupont">
                    @error('nom') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="telephone" class="block text-sm font-medium text-warm-gray">Téléphone <span class="text-red-500">*</span></label>
                    <input type="tel" id="telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}" required
                           class="input-field w-full mt-1" placeholder="+33 6 12 34 56 78">
                    @error('telephone') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Date de naissance -->
                <div>
                    <label for="date_naissance" class="block text-sm font-medium text-warm-gray">Date de naissance <span class="text-red-500">*</span></label>
                    <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $user->date_naissance) }}" required
                           class="input-field w-full mt-1">
                    @error('date_naissance') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Sexe -->
                <div>
                    <label for="sexe" class="block text-sm font-medium text-warm-gray">Sexe <span class="text-red-500">*</span></label>
                    <select id="sexe" name="sexe" required class="input-field w-full mt-1 appearance-none">
                        <option value="">Sélectionnez</option>
                        <option value="M" {{ old('sexe', $user->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                        <option value="F" {{ old('sexe', $user->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                        <option value="A" {{ old('sexe', $user->sexe) == 'A' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('sexe') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Groupe sanguin -->
                <div>
                    <label for="groupe_sanguin" class="block text-sm font-medium text-warm-gray">Groupe sanguin</label>
                    <select id="groupe_sanguin" name="groupe_sanguin" class="input-field w-full mt-1 appearance-none">
                        <option value="">Non renseigné</option>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $g)
                            <option value="{{ $g }}" {{ old('groupe_sanguin', $user->groupe_sanguin) == $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                    @error('groupe_sanguin') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Poids -->
                <div>
                    <label for="poids" class="block text-sm font-medium text-warm-gray">Poids (kg)</label>
                    <input type="number" id="poids" name="poids" value="{{ old('poids', $user->poids) }}" min="1" max="300" step="0.1"
                           class="input-field w-full mt-1" placeholder="70">
                    @error('poids') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Taille -->
                <div>
                    <label for="taille" class="block text-sm font-medium text-warm-gray">Taille (cm)</label>
                    <input type="number" id="taille" name="taille" value="{{ old('taille', $user->taille) }}" min="50" max="250"
                           class="input-field w-full mt-1" placeholder="175">
                    @error('taille') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Allergies -->
                <div class="md:col-span-2">
                    <label for="allergies" class="block text-sm font-medium text-warm-gray">Allergies</label>
                    <textarea id="allergies" name="allergies" rows="2" class="input-field w-full mt-1" placeholder="Ex: pénicilline, arachides...">{{ old('allergies', $user->allergies) }}</textarea>
                    @error('allergies') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Traitements -->
                <div class="md:col-span-2">
                    <label for="traitements" class="block text-sm font-medium text-warm-gray">Traitements en cours</label>
                    <textarea id="traitements" name="traitements" rows="2" class="input-field w-full mt-1" placeholder="Médicaments, doses, fréquence...">{{ old('traitements', $user->traitements) }}</textarea>
                    @error('traitements') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Antécédents personnels -->
                <div>
                    <label for="antecedents_personnels" class="block text-sm font-medium text-warm-gray">Antécédents personnels</label>
                    <textarea id="antecedents_personnels" name="antecedents_personnels" rows="2" class="input-field w-full mt-1" placeholder="Chirurgies, maladies chroniques...">{{ old('antecedents_personnels', $user->antecedents_personnels) }}</textarea>
                    @error('antecedents_personnels') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Antécédents familiaux -->
                <div>
                    <label for="antecedents_familiaux" class="block text-sm font-medium text-warm-gray">Antécédents familiaux</label>
                    <textarea id="antecedents_familiaux" name="antecedents_familiaux" rows="2" class="input-field w-full mt-1" placeholder="Maladies héréditaires...">{{ old('antecedents_familiaux', $user->antecedents_familiaux) }}</textarea>
                    @error('antecedents_familiaux') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Médecin traitant -->
                <div>
                    <label for="medecin_nom" class="block text-sm font-medium text-warm-gray">Nom du médecin traitant</label>
                    <input type="text" id="medecin_nom" name="medecin_nom" value="{{ old('medecin_nom', $user->medecin_nom) }}"
                           class="input-field w-full mt-1" placeholder="Dr. Dupont">
                    @error('medecin_nom') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Téléphone médecin -->
                <div>
                    <label for="medecin_telephone" class="block text-sm font-medium text-warm-gray">Téléphone du médecin</label>
                    <input type="tel" id="medecin_telephone" name="medecin_telephone" value="{{ old('medecin_telephone', $user->medecin_telephone) }}"
                           class="input-field w-full mt-1" placeholder="01 23 45 67 89">
                    @error('medecin_telephone') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Adresse -->
                <div class="md:col-span-2">
                    <label for="adresse" class="block text-sm font-medium text-warm-gray">Adresse</label>
                    <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $user->adresse) }}"
                           class="input-field w-full mt-1" placeholder="12 rue des Lilas, 75000 Paris">
                    @error('adresse') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Ville -->
                <div>
                    <label for="ville" class="block text-sm font-medium text-warm-gray">Ville</label>
                    <input type="text" id="ville" name="ville" value="{{ old('ville', $user->ville) }}"
                           class="input-field w-full mt-1" placeholder="Paris">
                    @error('ville') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Code postal -->
                <div>
                    <label for="code_postal" class="block text-sm font-medium text-warm-gray">Code postal</label>
                    <input type="text" id="code_postal" name="code_postal" value="{{ old('code_postal', $user->code_postal) }}"
                           class="input-field w-full mt-1" placeholder="75000">
                    @error('code_postal') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Pays -->
                <div>
                    <label for="pays" class="block text-sm font-medium text-warm-gray">Pays</label>
                    <input type="text" id="pays" name="pays" value="{{ old('pays', $user->pays ?? 'France') }}"
                           class="input-field w-full mt-1" placeholder="France">
                    @error('pays') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Téléphone d'urgence -->
                <div>
                    <label for="telephone_urgence" class="block text-sm font-medium text-warm-gray">Téléphone d'urgence</label>
                    <input type="tel" id="telephone_urgence" name="telephone_urgence" value="{{ old('telephone_urgence', $user->telephone_urgence) }}"
                           class="input-field w-full mt-1" placeholder="06 12 34 56 78">
                    @error('telephone_urgence') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Langue préférée -->
                <div>
                    <label for="langue_preferee" class="block text-sm font-medium text-warm-gray">Langue préférée</label>
                    <select id="langue_preferee" name="langue_preferee" class="input-field w-full mt-1 appearance-none">
                        <option value="fr" {{ old('langue_preferee', $user->langue_preferee) == 'fr' ? 'selected' : '' }}>Français</option>
                        <option value="en" {{ old('langue_preferee', $user->langue_preferee) == 'en' ? 'selected' : '' }}>Anglais</option>
                        <option value="pt" {{ old('langue_preferee', $user->langue_preferee) == 'pt' ? 'selected' : '' }}>Portugais</option>
                        <option value="sw" {{ old('langue_preferee', $user->langue_preferee) == 'sw' ? 'selected' : '' }}>Swahili</option>
                        <option value="ha" {{ old('langue_preferee', $user->langue_preferee) == 'ha' ? 'selected' : '' }}>Haoussa</option>
                        <option value="yo" {{ old('langue_preferee', $user->langue_preferee) == 'yo' ? 'selected' : '' }}>Yoruba</option>
                        <option value="ig" {{ old('langue_preferee', $user->langue_preferee) == 'ig' ? 'selected' : '' }}>Igbo</option>
                        <option value="am" {{ old('langue_preferee', $user->langue_preferee) == 'am' ? 'selected' : '' }}>Amharique</option>
                        <option value="ar" {{ old('langue_preferee', $user->langue_preferee) == 'ar' ? 'selected' : '' }}>Arabe</option>
                    </select>
                    @error('langue_preferee') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex flex-wrap gap-3 justify-between items-center mt-8 pt-6 border-t border-white/30">
                <a href="{{ route('patient.medical-record') }}" class="text-sm text-warm-gray hover:text-primary transition">
                    <i class="fas fa-arrow-left mr-1"></i> Annuler
                </a>
                <button type="submit" class="btn-primary px-6">
                    <i class="fas fa-save mr-1"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>

    <!-- Section changement de mot de passe -->
    <div class="glass-card p-6 md:p-8 mt-6">
        <h3 class="text-xl font-display font-semibold text-primary mb-4">Changer mon mot de passe</h3>
        <form method="POST" action="{{ route('patient.medical-record.change-password') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-warm-gray">Mot de passe actuel <span class="text-red-500">*</span></label>
                    <input type="password" id="current_password" name="current_password" required class="input-field w-full mt-1">
                    @error('current_password') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-warm-gray">Nouveau mot de passe <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" required class="input-field w-full mt-1" placeholder="Minimum 8 caractères">
                    @error('password') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-warm-gray">Confirmation <span class="text-red-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="input-field w-full mt-1">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="btn-primary text-sm px-5">
                        <i class="fas fa-key mr-1"></i> Changer le mot de passe
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection